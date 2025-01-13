<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserCrud extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
         // Query data pengguna dengan pencarian
         $users = Users::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . (string)$search . '%')
                         ->orWhere('email', 'like', '%' . (string)$search . '%');
        })->paginate(5);

    // Kirim data ke view
    return view('users', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required|string|max:255',
        ]);


        $user = Users::create($validatedData);

        return redirect()->route('users.index')->with('success', "User '{$user->name}' created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = Users::findOrFail($id);
        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = Users::findOrFail($id);
        return view('edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Cari pengguna berdasarkan ID
    $user = Users::findOrFail($id);

    // Validasi data yang diperbarui
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'alamat' => 'required|string|max:255',
    ]);

    // Perbarui data pengguna
    $user->update($validatedData);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('users.index')->with('success', "User '{$user->name}' updated successfully.");
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari pengguna berdasarkan ID
        $user = Users::findOrFail($id);

        // Mengambil atribut 'name' dari pengguna
        $name = $user->name;

        // Menghapus data pengguna
        $user->delete();

        // Mendapatkan halaman saat ini dari query parameter
        $currentPage = request()->query('page', 1); // Default ke halaman 1 jika tidak ada query 'page'

        // Redirect ke halaman dengan pesan sukses
        return redirect()->route('users.index', ['page' => $currentPage])
                        ->with('success-delete', "User '{$name}' deleted successfully.");
    }

}
