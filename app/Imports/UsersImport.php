<?php

namespace App\Imports;

use App\Events\Register;
use App\Jobs\SendEmail;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class UsersImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // if(!array_filter($row)) {
        //     return null;
        //  } 
        $user =  new User([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'password' => Hash::make($row['password']),
 
        ]);
          $user->notify(new RegisteredUserNotification());
        // info($user);
        // SendEmail::dispatch($user);
            // event(new Register($user));
              // Notification::route('mail', $user->email)->notify(new RegisteredUserNotification());            
        return $user; 
    }

    public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required',
    ];
  }

  public function chunkSize(): int
  {
      return 100;
  }

  public function batchSize(): int
  {
      return 100;
  }
  public function onFailure(\Maatwebsite\Excel\Validators\Failure ...$failures)
  {
  }
}
