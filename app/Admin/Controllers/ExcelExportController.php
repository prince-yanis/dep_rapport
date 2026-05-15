<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExcelExportController extends Controller
{
    private function getUserRole(): array
    {
        $user = AdminUser::find(Auth::id());

        if (!$user) {
            return ['role' => 'guest', 'etablissement_id' => null];
        }
        if ($user->idEtab === null && $user->idDR === null) {
            return ['role' => 'admin', 'etablissement_id' => null];
        }
        if ($user->idEtab !== null) {
            return ['role' => 'etablissement', 'etablissement_id' => $user->idEtab];
        }

        return ['role' => 'other', 'etablissement_id' => null];
    }

    public function export(Request $request, string $resource)
    {
        $userRole = $this->getUserRole();

        if (!in_array($userRole['role'], ['admin', 'etablissement'])) {
            abort(403, 'Accès non autorisé.');
        }

        switch ($resource) {

            case 'entreprises':
                $query = Entreprise::withCount(['stages']);

                if ($request->filled('raison_sociale')) {
                    $query->where('raison_sociale', 'like', '%' . $request->raison_sociale . '%');
                }
                if ($request->filled('sigle')) {
                    $query->where('sigle', 'like', '%' . $request->sigle . '%');
                }
                if ($request->filled('ville')) {
                    $query->where('ville', 'like', '%' . $request->ville . '%');
                }
                if ($request->filled('statut')) {
                    $query->where('statut', $request->statut);
                }

                $data    = $query->get();
                $columns = [
                    'id'                    => 'ID',
                    'raison_sociale'        => 'Raison Sociale',
                    'sigle'                 => 'Sigle',
                    'secteur_activite'      => 'Secteur Activité',
                    'adresse'               => 'Adresse',
                    'ville'                 => 'Ville',
                    'telephone'             => 'Téléphone',
                    'email'                 => 'Email',
                    'responsable'           => 'Responsable',
                    'fonction_responsable'  => 'Fonction Responsable',
                    'telephone_responsable' => 'Téléphone Responsable',
                    'email_responsable'     => 'Email Responsable',
                    'statut'                => 'Statut',
                    'stages_count'          => 'Nombre de stages',
                    'created_at'            => 'Date de création',
                ];
                $filename = 'entreprises_' . date('Y-m-d_H-i-s') . '.xlsx';
                break;

            default:
                abort(404, 'Ressource inconnue.');
        }

        // ── Construire le classeur ─────────────────────────────────────────
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle(ucfirst($resource));

        // En-têtes (ligne 1)
        $colIdx = 1;
        foreach ($columns as $label) {
            $addr = Coordinate::stringFromColumnIndex($colIdx) . '1';
            $sheet->setCellValue($addr, $label);
            $sheet->getStyle($addr)->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF1F4E79'],
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $colIdx++;
        }

        // Données (à partir de la ligne 2)
        $rowIdx = 2;
        foreach ($data as $row) {
            $colIdx = 1;
            foreach (array_keys($columns) as $key) {
                $value = $row->{$key} ?? '';
                if ($key === 'statut') {
                    $value = $value ? 'Actif' : 'Inactif';
                }
                if (in_array($key, ['created_at', 'updated_at']) && $value) {
                    $value = \Carbon\Carbon::parse($value)->format('d/m/Y H:i');
                }
                $addr = Coordinate::stringFromColumnIndex($colIdx) . $rowIdx;
                $sheet->setCellValue($addr, $value);
                $colIdx++;
            }
            $rowIdx++;
        }

        // Auto-largeur
        foreach (range(1, count($columns)) as $col) {
            $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }

        // ── Écrire dans un fichier temporaire ─────────────────────────────
        $tmpFile = tempnam(sys_get_temp_dir(), 'excel_') . '.xlsx';
        (new Xlsx($spreadsheet))->save($tmpFile);

        // ── Vider tous les buffers de sortie ──────────────────────────────
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        // ── Envoyer les headers puis le fichier binaire, puis quitter ─────
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($tmpFile));
        header('Cache-Control: max-age=0, no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        readfile($tmpFile);
        unlink($tmpFile);
        exit;
    }
}
