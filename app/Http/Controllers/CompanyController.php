<?php

namespace App\Http\Controllers;


use App\Company;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Image;
class CompanyController extends Controller
{
    public function index()
    {
        //return view ('/home');
        $companies = Company::all();
        return view('profile/{id}', compact('contacts'));

    }

    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
            $request -> validate([
                'company_name'=>'required',
                'contact_name'=>'required',
                'email' => 'unique:companies,email,$this->id,id',
                'phone' => 'required',
                'address' => 'required',
                'company_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company_file1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company_file2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company_file3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company_file4' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            
 
                $image = $request->file('company_file');
                $filename = $image->getClientOriginalName();
                $destinationPath = public_path('upload');
                $img = Image::make($image->path());
                $img->resize(300, 200)->save($destinationPath.'/'.$filename);
                $image->move($destinationPath, $filename);
        
                 
                $image1 = $request->file('company_file1');
                $filename1 = $image1->getClientOriginalName();
                $destinationPath = public_path('upload');
                $img1 = Image::make($image1->path());
                $img1->resize(300, 200)->save($destinationPath.'/'.$filename1);
                $image1->move($destinationPath, $filename1);

                 
                $image2 = $request->file('company_file2');
                $filename2 = $image2->getClientOriginalName();
                $destinationPath = public_path('upload');
                $img2 = Image::make($image2->path());
                $img2->resize(300, 200)->save($destinationPath.'/'.$filename2);
                $image2->move($destinationPath, $filename2);
                 
                $image3 = $request->file('company_file3');
                $filename3 = $image3->getClientOriginalName();
                $destinationPath = public_path('upload');
                $img3 = Image::make($image3->path());
                $img3->resize(300, 200)->save($destinationPath.'/'.$filename3);
                $image3->move($destinationPath, $filename3);
                 
                $image4 = $request->file('company_file4');
                $filename4 = $image4->getClientOriginalName();
                $destinationPath = public_path('upload');
                $img4 = Image::make($image4->path());
                $img4->resize(300, 200)->save($destinationPath.'/'.$filename4);
                $image4->move($destinationPath, $filename4);

                Company::create([
                    'company_name' => $request->get('company_name'),
                    'contact_name' => $request->get('contact_name'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'company_file' => $filename,
                    'company_file1' => $filename1,
                    'company_file2' => $filename2,
                    'company_file3' => $filename3,
                    'company_file4' => $filename4,
                    'address' => $request->get('address'),
                ]);
        
                return redirect('/home')->with('success', 'Record is successfully saved.');

    }
 
          

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $companies = Company::all();
        return view ('/user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}