<?php

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LireFileExcelController extends AbstractController
{
    #[Route('/lire/file/excel', name: 'lire_file_excel')]
    public function index(): Response
    {

        $reader = new Xlsx();
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load("uploads/odc_mali.xlsx");
        $worksheet = $spreadsheet->getActiveSheet();
    
        $highestRow = $worksheet->getHighestRow(); 
        $highestColumn = $worksheet->getHighestColumn(); 
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    $res = array();
        for($row=1; $row < $highestRow ; $row++){
            for($col = 1; $col <= $highestColumnIndex; $col++){
                $value = $worksheet->getCellByColumnAndRow($col,$row)->getValue();
                echo `<script>alert(\"la variable est nulle\")</script>`;
                array_push($res,$value);
            }
        }
    
    
        return $this->render('lire_file_excel/index.html.twig', [
            'list' => $res,
        ]);
        // return $this->render('lire_file_excel/index.html.twig', [
        //     'controller_name' => 'LireFileExcelController',
        // ]);
    }
}
