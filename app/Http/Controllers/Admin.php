<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggaran;
use App\Models\TahunAkademik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Admin extends Controller
{

    protected $userModel;
    protected $profileUserModel;
    protected $kritikSaranModel;
    protected $kuisionerModel;
    protected $penilaianModel;


    public function __construct()
    {
        $this->userModel = new User();
    }

    public function pengguna()
    {
        $data['pengguna'] = $this->userModel->getAllUser();
        return view('pages.pengguna.index', $data);
    }

    public function jenisAnggaran()
    {
        $data['jenis_anggaran'] = JenisAnggaran::all();
        return view('pages.jenis_anggaran.index', $data);
    }

    public function tahunAkademik()
    {
        $data['tahun_akademik'] = TahunAkademik::all();
        return view('pages.tahun_akademik.index', $data);
    }



    public function profileUser()
    {
        $data['user'] = User::all();
        $data['profile'] = $this->profileUserModel->getProfileUser();
        return view('pages.rekaptulasi_data.index', $data);
    }






    // fetch data user by admin
    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if ($request->filter == "") {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            } else {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('role', '=', $request->filter)
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            }

            return view('pages.pengguna.users_data', $data)->render();
        }
    }

    // CRUD TAHUN AJARAN

    public function createTahunAkademik(Request $request)
    {
        TahunAkademik::create([
            'nama_tahun_akademik' => $request->nama_tahun_akademik,
        ]);
        return redirect()->back()->with('message', 'tahun Berhasil di tambahkan');
    }

    public function updateTahunAkademik(Request $request)
    {
        $data = TahunAkademik::where([
            ['id_tahun_akademik', '=', $request->id]
        ])->first();
        $data->update([
            'nama_tahun_akademik' => $request->nama_tahun_akademik,
        ]);
        return redirect()->back()->with('message', 'tahun akademik Berhasil di update');
    }

    public function deleteTahunAkademik(Request $request)
    {
        $data = TahunAkademik::where([
            ['id_tahun_akademik', '=', $request->id]
        ])->delete();
        return 1;
    }

    // CRUD PENGGUNA

    public function createPengguna(Request $request)
    {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->email),
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di tambahkan');
    }

    public function updatePengguna(Request $request)
    {
        $user = User::where([
            ['id', '=', $request->id]
        ])->first();
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di update');
    }

    public function deletePengguna(Request $request)
    {
        User::destroy($request->post('user_id'));
        return 1;
    }

    public function aktifkanTahunAkademik($idTahunAkademik)
    {
        TahunAkademik::query()->update(['status' => '0']);

        TahunAkademik::where('id_tahun_akademik', $idTahunAkademik)->update([
            'status' => '1'
        ]);

        return redirect()->back()->with('message', 'berhasil di aktifkan');
    }


    // CRUD JENIS ANGGARAN

    public function createJenisAnggaran(Request $request)
    {
        JenisAnggaran::create([
            'id_tahun_akademik' => getTahunAkademikAktif()->id_tahun_akademik,
            'nama_anggaran' => $request->nama_anggaran,
            'jumlah_anggaran' => $request->jumlah_anggaran,
            'kode_anggaran' => $request->kode_anggaran,
        ]);
        return redirect()->back()->with('message', 'jenis anggaran Berhasil di tambahkan');
    }

    public function updateJenisAnggaran(Request $request)
    {
        $user = JenisAnggaran::where([
            ['id_jenis_anggaran', '=', $request->id]
        ])->update([
            'nama_anggaran' => $request->nama_anggaran,
            'jumlah_anggaran' => $request->jumlah_anggaran,
            'kode_anggaran' => $request->kode_anggaran,
        ]);
        return redirect()->back()->with('message', 'jenis anggaran Berhasil di update');
    }

    public function deleteJenisAnggaran(Request $request)
    {
        $user = JenisAnggaran::where([
            ['id_jenis_anggaran', '=', $request->id]
        ])->delete();
        return 1;
    }
}
