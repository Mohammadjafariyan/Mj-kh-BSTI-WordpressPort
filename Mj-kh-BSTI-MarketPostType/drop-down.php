<?php ?>



<div style="width:50%">
<select name="mj_kh_bsti_product_dropdown" id="mj_kh_bsti_product_dropdown">

<option value="USA" <?php if($dropdown_value == 'USA') echo 'selected'; ?>>USA</option>
        <option value="Canada" <?php if($dropdown_value == 'Canada') echo 'selected'; ?>>Canada</option>
        <option value="Mexico" <?php if($dropdown_value == 'Mexico') echo 'selected'; ?>>MEXICO</option>
    </select>

</div>


    <script>

jQuery(function ($) {
    /* You can safely use $ in this code block to reference jQuery */

    $(document).ready(function(){
        $('select[name="mj_kh_bsti_product_dropdown"]').select2({
  ajax: {
    url: 'https://my-json-server.typicode.com/Mohammadjafariyan/fakedb/cars',
    dataType: 'json',
    data: function (params) {
      var query = {
        search: params.term,
        page: params.page || 1
      }

      // Query parameters will be ?search=[term]&page=[page]
      return query;
    }
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});

    })
});

</script>