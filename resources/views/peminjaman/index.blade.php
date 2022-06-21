@extends('layout')
@section('judul','Peminjaman')
@section('isi')
<style>

    .table {
    width: 100%;
    }
</style>
<div class="card" style="width:105%;margin-left:-1.5rem">
    <div class="card-body">
        <div class="input-group input-group-sm mb-3 col-4" style="float:right">
            <input type="search" name="search" id="search" class="form-control" placeholder="Search Barang & Jenis Barang">
            <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
          </div>
        <a href="/" class="btn btn-primary mb-4"><i
                class="fas fa-plus"></i><span class="px-2">Tambah</span></a>
        <table class="table table-hover table-bordered table-responsive" id="barang-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Nama Peminjam</th>
                    <th scope="col">Status Peminjam</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Jumlah Pinjam</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Nama Operator</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="alldata">
                <tr>
                  <th scope="row">1</th> 
                  <td>lala</td>                        
                  <td>pau</td>
                  <td>harry</td>
                  <td>jerry</td>
                  <td>tom</td>
                  <td>yeri</td>
              </tr>
            </tbody>
              <tbody id="contentnya" class="searchdata"></tbody>
        </table>
        <div class="paginatenya mt-3">
        {{-- {{ $barang->links() }} --}}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xU+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.7.0/validator.min.js" integrity="sha512-rJU+PnS2bHzDCvRGFhXouCSxf4YYaUyUfjXMHsHFfMKhWDIEBr8go2LZ2EYXOqASey1tWc2qToeOCYh9et2aGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

    <script>
            
      $('.delete').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete ${name}?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
          swal("Data berhasil di hapus", {
                icon: "success",
                });
        }else 
        {
          swal("Data tidak jadi dihapus");
        }
      });
  });
    </script>

<script>
    $(document).ready(function(){
     $('#search').on('keyup',function(){
         $value= $(this).val();
         if($value)
         {
          $('.alldata').hide();
          $('.searchdata').show();
         }

         else
         {
          $('.alldata').show();
          $('.searchdata').hide();
         }
         $.ajax({
            url:'{{URL::to('search')}}',
            type:"GET",
            data:{'search':$value},
            success:function(data){
                $('#contentnya').html(data);
            }
     });
     //end of ajax call
    });
    });
</script>

<script>
    @if (Session:: has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif
</script>

@endpush