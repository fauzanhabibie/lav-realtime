<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $client = new Client();
    //     $token = 'asnjpdubjV0wh2VADfmdXkLVPjp9OFi6PUmLvOCC5d725118'; // token API Anda

    //     $response = $client->request('GET', 'http://127.0.0.1:8000/api/karyawan000890er', [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $token,
    //         ]
    //     ]);
    //     $body = $response->getBody()->getContents();
    //     $data = json_decode($body, true);

    //     $employees = json_encode($data)['employees'];

    //     return view('employe-ajax.index', compact('employees'));
    // }
    
    // public function index()
    // {
    //     $client = new Client();
    //     $token = 'asnjpdubjV0wh2VADfmdXkLVPjp9OFi6PUmLvOCC5d725118'; // token API Anda

    //     try {
    //         $response = $client->request('GET', 'http://127.0.0.1:8000/api/karyawan000890er', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $token,
    //             ]
    //         ]);

    //         $body = $response->getBody()->getContents();
    //         $data = json_decode($body, true);

    //         if (isset($data['data'])) {
    //             $employees = $data['data'];
    //             return view('employe-ajax.index', compact('employees'));
    //         } else {
    //             throw new \Exception('Key "data" tidak ditemukan dalam respons API: ' . json_encode($data));
    //         }
    //     } catch (RequestException $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Error saat mengakses API: ' . $e->getMessage()
    //         ], 500);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Error: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function index()
    {
        $client = new Client();
        $token = 'asnjpdubjV0wh2VADfmdXkLVPjp9OFi6PUmLvOCC5d725118'; // token API Anda

        try {
            // Ambil data karyawan
            $response = $client->request('GET', 'http://127.0.0.1:8000/api/karyawan000890er', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            if (isset($data['data'])) {
                $employees = $data['data'];
    
                // Ambil data tambahan: company, departemen, jabatan, dan user
                $responseCompany = $client->request('GET', 'http://127.0.0.1:8000/api/company000890er', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ]
                ]);
                $dataCompany = json_decode($responseCompany->getBody()->getContents(), true)['data'];
    
                $responseDepartemen = $client->request('GET', 'http://127.0.0.1:8000/api/departemen000890er', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ]
                ]);
                $dataDepartemen = json_decode($responseDepartemen->getBody()->getContents(), true)['data'];
    
                $responseJabatan = $client->request('GET', 'http://127.0.0.1:8000/api/jabatan000890er', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ]
                ]);
                $dataJabatan = json_decode($responseJabatan->getBody()->getContents(), true)['data'];
    
                $responseUser = $client->request('GET', 'http://127.0.0.1:8000/api/user000890er', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ]
                ]);
                $dataUser = json_decode($responseUser->getBody()->getContents(), true)['data'];
    
                return view('employe-ajax.index', compact('employees', 'dataCompany', 'dataDepartemen', 'dataJabatan', 'dataUser'));
            } else {
                throw new \Exception('Key "data" tidak ditemukan dalam respons API karyawan: ' . json_encode($data));
            }
        } catch (RequestException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error saat mengakses API: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employe-ajax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric',
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Simpan produk baru ke dalam database
        $employee = Karyawan::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        // Kirim respons JSON berisi data karyawan yang baru saja dibuat
        return response()->json(['data' => $employee]);

        // Kembali ke halaman sebelumnya
        return back();
    }

    public function deleteKaryawan($id)
    {
        $client = new Client();
        $token = 'asnjpdubjV0wh2VADfmdXkLVPjp9OFi6PUmLvOCC5d725118'; // token API Anda

        try {
            $response = $client->request('DELETE', 'http://127.0.0.1:8000/api/karyawandelet/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            if ($data['status'] == 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Karyawan berhasil dihapus'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $data['message']
                ], 400);
            }
        } catch (RequestException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error saat mengakses API: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }
}
