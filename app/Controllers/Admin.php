<?php

namespace App\Controllers;

use App\Models\TestimonialModel;

class Admin extends BaseController
{

    public function __construct()
    {
        helper(['form']);
        $this->Testimonial = new TestimonialModel();
    }


    public function home()
    {
        $data = [
            'title' => 'Home',
            'content' => 'admin/home/index'
        ];
        return view('_layouts/v_wrapper.php', $data);
    }

    public function testimonial()
    {
        $data = [
            'title' => 'Testimonial',
            'content' => 'admin/testimonial/index',
            'testimonial' => $this->Testimonial->getTestimonial()
        ];
        return view('_layouts/v_wrapper.php', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Testimonial Create',
            'content' => 'admin/testimonial/create'
        ];
        return view('_layouts/v_wrapper.php', $data);
    }

    public function store()
    {
        $image = $this->request->getFile('image');
        $name = $image->getRandomName();

        $data = [
            'image' => $name,
            'username' => $this->request->getPost('username'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        $image->move(ROOTPATH . 'public/uploads', $name);

        $simpan = $this->Testimonial->insertTestimonial($data);

        return redirect()->to(base_url('admin/testimonial'));
    }

    //--------------------------------------------------------------------

}
