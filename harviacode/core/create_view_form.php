<?php

$string = "<div class=\"row\">
  <div class=\"col-12\">
    <div class=\"card\">
        <div class=\"card-body\">
            <h4 class=\"card-title\">Tambah ".ucfirst($table_name)."</h4>
            <form class=\"form-material m-t-40\" method=\"post\" action=\"<?php echo base_url().\$action ?>\">";

foreach ($non_pk as $row) {

    $string .= "\n\t  <div class=\"form-group\">
            <label>".$row["column_name"]."</label>
            <input type=\"text\" name=\"".$row["column_name"]."\" class=\"form-control\" placeholder=\"\">
    </div>";

}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" /> ";
$string .= "\n\t
                <div class=\"form-group\">
                  <button type=\"submit\" class=\"btn btn-success waves-effect waves-light m-r-10\">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
";


$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>
