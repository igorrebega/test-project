<form action="" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Login</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Login" name="login" value="<?= $model->login?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="<?= $model->password?>">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>