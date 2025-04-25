<?php

namespace App\Imports;

use App\Models\EntryFormat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class EntryFormatImport implements ToModel, WithHeadingRow
{
    protected $count = 0;

    public function model(array $row)
    {
        if ($this->count >= 12269) {
            return null;
        }

        $this->count++;
        // $particles = ['de', 'del', 'la', 'las', 'los', 'san', 'santa'];

        // $fullName = trim($row['legal_names'] ?? '');
        // $parts = preg_split('/\s+/', $fullName);
        // $count = count($parts);

        // $name = '';
        // $middle_name = null;
        // $last_name = '';
        // $mother_last_name = null;

        // if ($count >= 1) {
        //     $name = $parts[0];

        //     if ($count >= 2) {
        //         $possibleLast = array_slice($parts, -4);
        //         $reversed = array_reverse($possibleLast);
        //         $apellido1 = [];
        //         $apellido2 = [];
        //         $foundFirst = false;

        //         foreach ($reversed as $word) {
        //             $wordLower = strtolower($word);
        //             if (in_array($wordLower, $particles) || !$foundFirst) {
        //                 array_unshift($apellido2, $word);
        //                 $foundFirst = true;
        //             } else {
        //                 array_unshift($apellido1, $word);
        //             }

        //             if (count($apellido1) > 0 && count($apellido2) > 0) {
        //                 break;
        //             }
        //         }

        //         $last_name = implode(' ', $apellido1);
        //         $mother_last_name = implode(' ', $apellido2);

        //         $middleParts = array_slice($parts, 1, $count - count($apellido1) - count($apellido2) - 1);
        //         $middle_name = count($middleParts) ? implode(' ', $middleParts) : null;
        //     }
        // }

        try {
            $birthdate = !empty($row['birthdate']) 
                ? Carbon::createFromFormat('M d, Y', trim($row['birthdate']))->format('Y-m-d') 
                : '1900-01-01';

            $today_date = !empty($row['today_date']) 
                ? Carbon::createFromFormat('M d, Y', trim($row['today_date']))->format('Y-m-d') 
                : now()->format('Y-m-d');
        } catch (\Exception $e) {
            return;
        }

        $ssn = preg_replace('/[^0-9]/', '', $row['u_s_social_security_number_ssn'] ?? '000000000');
        $ssn = str_pad($ssn, 9, '0');
        $ssn = substr($ssn, 0, 3) . '-' . substr($ssn, 3, 2) . '-' . substr($ssn, 5, 4);
        $name = $row['legal_names'];
        return new EntryFormat([
            'name' => $name ?: 'N/A',
            'middle_name' => '',
            'last_name' => 'N/A',
            'mother_last_name' => '',
            'phone' => $row['phone'] ?? '0',
            'ssn' => $ssn,
            'email' => $row['email'] ?? 'no-email@example.com',
            'birthdate' => $birthdate,
            'today_date' => $today_date,
            'country_id' => 116,
            'language_id' => 3,
        ]);
    }
}