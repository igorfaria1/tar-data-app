<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use League\Csv\Reader;

class FileService 
{
    public function compareCSVs(Request $request) {
        $newestLines = $this->readCSV($request->file('newest_file'));
        $oldestLines = iterator_to_array($this->readCSV($request->file('oldest_file')), true);

        $results = [
            'equals' => [],
            'updated' => [],
            'news' => []
        ];

        foreach ($newestLines as $key => $newLine) {
            $fileLine = $key + 1;

            if (isset($oldestLines[$key])) {
                if ($this->areRowsEqual($newLine, $oldestLines[$key])) {
                    $results['equals'][] = [
                        'line_number' => $fileLine,
                        'value' => $newLine
                    ];
                } else {
                    $results['updated'][] = [
                        'line_number' => $fileLine,
                        'new' => $newLine,
                        'old' => $oldestLines[$key]
                    ];
                }
            } else {
                if (!$this->existSameRows($newLine, $oldestLines)) {
                    $results['news'][] = [
                        'line_number' => $fileLine,
                        'value' => $newLine
                    ];
                }
            }
        }

        return $results;
    }


    private function readCSV($file)
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        return $csv->getRecords();
    }

    private function existSameRows($newLine, $oldestLines)
    {
        foreach ($oldestLines as $oldLine) {
            if ($this->areRowsEqual($newLine, $oldLine)) {
                return true;
            }
        }

        return false;
    }

    private function areRowsEqual($row1, $row2)
    {
        return ($row1 == $row2);
    }
}