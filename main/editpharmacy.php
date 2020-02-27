
        <form action="saveedithospital.php" method="POST">
          <label>pharmacy name</label>
     <input type="text" placeholder="hospital name" id="example-text-input" name="name" value="<?php echo $_GET['name']; ?>" autocomplete="false" required/>
     <label>physical address</label>
  <input type="text" placeholder="address" id="example-search-input" name="address" value="<?php echo $_GET['address']; ?>" autocomplete="false" required/>
  <label>phone</label>
  <input type="text" placeholder="telephone" id="example-email-input" name="telephone" value="<?php echo $_GET['phone']; ?>" autocomplete="false" required/>
  <label>slogan</label>
  <input type="text" placeholder="slogan" id="example-email-input" name="slogan" value="<?php echo $_GET['slogan']; ?>" autocomplete="false"required/>
  <button class="btn btn-success" style="border-radius: 3px;width: 98%;">save</button>
</form>
     