<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5>Ubah Password</h5>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <!-- <form action="{{route('change_password')}}" method="post"> -->
            <form id="frmPassword">
                <!-- <input name="_token" type="hidden" value="{{ csrf_token() }}"/> -->
                <div class="form-group">
                    <label for="exampleInputEmail1" required>Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" readonly value="{{\Auth::user()->email}}" required>
                    <small id="emailHelp" class="form-text text-muted">Kita tidak akan pernah menyebarluaskan email anda kepada orang lain.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" required>Password Lama</label>
                    <input type="password" name="oldPass" class="form-control" id="oldPass" placeholder="Password Lama Anda" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" required>Password Baru</label>
                    <input type="password" name="Pass" class="form-control" id="Pass" placeholder="Password Baru Anda" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" required>Konfirmasi Password</label>
                    <input type="password" name="konfPass" class="form-control" id="konfPass" placeholder="Konfirmasi Password Baru Anda" required>
                </div>
                <button type="button" class="btn btn-primary" id="changePass">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
$(function() {
    $("#changePass").click(function () {
        var formData = $("#frmPassword").serializeArray();
        // console.log(formData[0]['name']);
        var email = formData[0]['value'];
        var oldPass = formData[1]['value'];
        var pass = formData[2]['value'];
        var konfPass = formData[3]['value'];

        if(email==""){
            alert("Email tidak boleh ksosong");
            return false;
        }
        if(oldPass==""){
            alert("Password lama wajib diisi");
            return false;
        }
        if(pass==""){
            alert("Password wajib diisi");
            return false;
        }
        if(konfPass==""){
            alert("Password Konfirmasi wajib diisi");
            return false;
        }
        $.ajax({
            url: "{{route('change_password')}}",
            type: 'POST',
            data: {_token: "{{ csrf_token() }}", arrData:formData},
            dataType: 'JSON',
            success: function (data){
                // console.log(data.error);
                if(data.error){
                    alert(data.error);
                    return false;
                }
                else{
                    alert(data.success)
                    window.location.reload();
                }
                
            }
        })
    })
})
</script>