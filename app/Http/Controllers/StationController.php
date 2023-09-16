<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Exception\DatabaseException;

class StationController extends Controller
{

    protected $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }
    public function station()
    {
        $database = app('firebase.database');

        $station = $database->getReference('Station');
        $stationData = $station->getValue();
        return view('station.index', compact('stationData'));
    }

    public function index()
    {
        $database = app('firebase.database');
        $slotData = $database->getReference('SPBKLU')->getSnapshot()->getValue();
        $stationData = $database->getReference('Station')->getSnapshot()->getValue();

        $slotCount = 0;
        $totalSlot = 0;

        if($slotData != null) {
            foreach ($slotData as $slotKey => $slotValue) {
                // Anda harus menyesuaikan "status" sesuai dengan struktur data yang ada
                if (isset($slotValue['Booked Status']) && $slotValue['Booked Status'] === 'Ready') {
                    $slotCount++;
                }
                if(strpos($slotKey, 'Slot') !== false)
                {
                    $totalSlot++;
                }

                // dd($slotCount);
            }
        }

        foreach($stationData as $stationKey => $stationValue)
        {
            $stationValue['slotCount'] = $slotCount;
            // dd($stationValue);
            // dd($stationKey);

        }

        return view('list.index', [
            'data' => $stationData,
            'slotCount' => $slotCount,
            'slotTotal' => $totalSlot
        ]);
    }
    public function index2()
    {
        try{
            $database = app('firebase.database');
            $reference = $database->getReference('Station');
            $referenceSPBKLU = $database->getReference('SPBKLU');

            $stationsnapshot = $reference->getValue();
            $spbklusnapshot = $referenceSPBKLU->getValue();
            $data = [];

            foreach ($stationsnapshot as $stationKey => $stationData) {
                $slotCount = 0;
                $totalSlot = 0;

                $stationName = $stationKey;
                if (isset($spbklusnapshot[$stationName])) {
                    $stationSlots = $spbklusnapshot[$stationName];
                    foreach ($stationSlots as $slotKey => $slotData) {
                        $totalSlot++;
                        if ($slotData['Booked Status'] == "Ready") {
                            $slotCount++;
                        }
                    }
                }
    
                $data[] = [
                    'key' => $stationKey,
                    'name' => $stationData['name'],
                    'location' => $stationData['cordinate'],
                    'image' => $stationData['image'],
                    'slotTotal' => $totalSlot,
                    'slotCount' => $slotCount
                ];
            }
            // dd($data);

            return view('list.index', compact('data'));

            // dd($data);
        } catch(DatabaseException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function index3()
    {
        try {
            //code
            $database = app('firebase.database');
            $availSlot = $database->getReference('Booked Status')->getSnapshot()->getValue();
            $slotData = $database->getReference('SPBKLU')->getSnapshot()->getValue();
            $stationData = $database->getReference('Station')->getSnapshot()->getValue();

            $slotCount = 0;
            $totalSlot = 0;

            foreach($availSlot as $data)
            {
                $totalSlot++;
                if($data === 'Ready'){
                    $slotCount++;
                }
            }

            // dd($totalSlot);

            return view('list.index', [
                'data' => $stationData,
                'slotCount' => $slotCount,
                'slotTotal' => $totalSlot
            ]);

        } catch (DatabaseException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function detail($id)
    {
        $database = app('firebase.database');
        $slot = $database->getReference('SPBKLU');
        $slotData = $slot->getValue();
        $station = $database->getReference('Station/'.$id);
        $stationData = $station->getValue();

        // dd($stationData);
        $slotCount = 0;
        $slotTotal = 0;

        if($slotData != null)
        {
            foreach($slotData as $slotKey => $slotValue)
            {
                if(strpos($slotKey, 'Slot') !== false)
                {
                    $slotTotal++;

                    if(isset($slotValue['Booked Status']) && $slotValue['Booked Status'] == 'Ready')
                    {
                        $slotCount++;
                    }
                }
            }
        }
        // dd($stationData);

        return view('list.detail', [
            'id' => $id,
            'data' => $stationData,
            'slotCount' => $slotCount,
            'slotTotal' => $slotTotal
        ]);
    }
    public function detail2($id)
    {
        try{
            $database = app('firebase.database');
            $reference = $database->getReference('Station/'.$id);
            $stationData = $reference->getValue();
            $spbklureference = $database->getReference('SPBKLU/'.$id);
            $spbkluData = $spbklureference->getValue();
            
            $data = [];

            $slotCount = 0;
            $totalSlot = 0;

            $stationName = $id;

            if ($spbkluData) {
                $slotKeys = array_keys($spbkluData);
                foreach ($slotKeys as $slotKey) {
                    $totalSlot++;
                    $slotData = $spbkluData[$slotKey];
                    if ($slotData['Booked Status'] == "Ready") {
                        $slotCount++;
                    }
                }
            }

            if($stationData)
            {
                $data = [
                    'id' => $id,
                    'name' => $stationData['name'],
                    'location' => $stationData['cordinate'],
                    'image' => $stationData['image'],
                    'slotCount' => $slotCount,
                    'slotTotal' => $totalSlot
                ];
                return view('list.detail', compact('data'));
            } else {
                return null;
            }
        }
        catch(DatabaseException $e)
        {
            return null;
        }   
    }
    
    public function detail3($id)
    {
        try {
            $database = app('firebase.database');
            $slot = $database->getReference('Booked Status');
            $slotData = $slot->getValue();
            $station = $database->getReference('Station/'.$id);
            $stationData = $station->getValue();

            // dd($stationData);
            $slotCount = 0;
            $slotTotal = 0;

            if($slotData != null)
            {
                foreach($slotData as $slotKey => $slotValue)
                {
                    if(strpos($slotKey, 'Slot') !== false)
                    {
                        $slotTotal++;

                        if($slotValue === 'Ready')
                        {
                            $slotCount++;
                        }
                    }
                }
            }
            // dd($slotCount);

            return view('list.detail', [
                'id' => $id,
                'data' => $stationData,
                'slotCount' => $slotCount,
                'slotTotal' => $slotTotal
            ]);
        } catch (DatabaseException $e) {
            $e->getMessage();
        }
    }  
    
    public function map()
    {   
        try {
            $database = app('firebase.database');
            $stationRef = $database->getReference('Station');
            $stationData = $stationRef->getValue();

            // dd($stationData);

            $stations = [];
            
            foreach($stationData as $key => $value)
            {
                $value['id'] = $key;
                $stations[] = $value;
            }

            // dd($value['id']);

            return view('maps.index', [
                'stations' => $stations,
                // 'key' => $value 
            ]);

        } catch (DatabaseException $e) {
            return $e->getMessage();
        }
    }

}
