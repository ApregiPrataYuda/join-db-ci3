//script join and alias name table in ci3

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_m extends CI_Model
{
  public function get($id = null)
  {

    $this->db->from('data_mhs');
    $this->db->select('data_mhs.*, matakuliah.name as matakuliah_name, dosen.name as dosen_names');//for alias name
    $this->db->join('matakuliah', 'data_mhs.matakuliah_id = matakuliah.matakuliah_id');//for join
    $this->db->join('dosen', 'data_mhs.dosen_id = dosen.dosen_id');
    $this->db->order_by('mahasiswa_id', 'asc');
    if ($id != null) {
      $this->db->where('mahasiswa_id', $id);
    }
    $query = $this->db->get();
    return $query;
  }
}


//hasil ketika di panggil di data views


 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-2 text-gray-800"><span class="badge badge-primary"> Data Mahasiswa</span></h1>
     <a href="<?= site_url('Dashboard') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-tachometer-alt fa-sm text-white-50"></i> Dashboard</a>
   </div>


   <div class="row">
     <div class="col-lg-12">
       <div id="flash" data-flash="<?= $this->session->flashdata('pesan') ?>">
         <div class="card shadow mb-4">
           <div class="card-header py-3">
             <a href="<?= site_url('Mahasiswa/Tambah') ?>" class="btn btn-outline-primary"> <i class="fa fa-save"> Tambah Data Mahasiswa</i></a>
           </div>
           <div class="card-body">

             <!-- DataTales Example -->
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Semua Data Mahasiswa</h6>
               </div>
               <div class="card-body">
                 <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                       <tr>
                         <th style="width:0%;">No#</th>
                         <th style="width:20%;">Nama Mahasiswa</th>
                         <th style="width:5%;">Jurusan Mahasiswa </th>
                         <th style="width:5%;">Matakuliah Mahasiswa </th>
                         <th style="width:5%;">Dosen</th>
                         <th style="width:5%;">Foto</th>
                         <th style="width:1%;">Pilihan</th>
                       </tr>
                     </thead>
                     <?php
                      $no = 1;
                      foreach ($row->result() as $key => $data) { ?>
                       <tr>
                         <td><?= $no++ ?></td>
                         <td><?= $data->name ?></td>
                         <td><?= $data->jurusan ?></td>
                         <td><?= $data->matakuliah_name ?></td>
                         <td><?= $data->dosen_names ?></td>
                         <td>
                           <?php if ($data->image != null) { ?>
                             <img src="<?= base_url('image/Mahasiswa/' . $data->image) ?>" style="width: 100px;" alt="Mhs">
                           <?php } ?>
                         </td>
                         <td>
                           <a href="<?= base_url('Mahasiswa/edit/' . $data->mahasiswa_id) ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                           <a href="<?= base_url('Mahasiswa/delete/' . $data->mahasiswa_id) ?>" id="btn-hapus" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                         </td>
                       </tr>
                     <?php } ?>
                   </table>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <p class=" footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
   </div>



