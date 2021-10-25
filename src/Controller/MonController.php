<?php

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MonController extends AbstractController
{
    
    /**
     * @Route("/hello", name="hello_world")
     */
    public function hello()
    {
        return new Response("hello world");
    }


    public function excelReader(){

        $reader = new Xlsx();
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load("odc_mali.xlsx");
        $worksheet = $spreadsheet->getActiveSheet();
    
        $highestRow = $worksheet->getHighestRow(); 
        $highestColumn = $worksheet->getHighestColumn(); 
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    $res = array();
        for($row=1; $row < $highestRow ; $row++){
            for($col = 1; $col <= $highestColumnIndex; $col++){
                $value = $worksheet->getCellByColumnAndRow($col,$row)->getValue();
                array_push($res,$value);
            }
        }
    
    
        return $this->render('table/excel.html.twig', [
            'list' => $res,
        ]);
    
     }
}