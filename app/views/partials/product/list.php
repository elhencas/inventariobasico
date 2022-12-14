<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Product</h4>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("product/add") ?>">
                        <i class="material-icons">add</i>                               
                        Agregar nuevo 
                    </a>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('product'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Buscar" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('product'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('product'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Buscar
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="product-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-image"> Image</th>
                                                <th  class="td-barcode"> Barcode</th>
                                                <th  class="td-name"> Name</th>
                                                <th  class="td-description"> Description</th>
                                                <th  class="td-inventary_min"> Inventary Min</th>
                                                <th  class="td-price_in"> Price In</th>
                                                <th  class="td-price_out"> Price Out</th>
                                                <th  class="td-unit"> Unit</th>
                                                <th  class="td-presentation"> Presentation</th>
                                                <th  class="td-user_id"> User Id</th>
                                                <th  class="td-category_id"> Category Id</th>
                                                <th  class="td-created_at"> Created At</th>
                                                <th  class="td-is_active"> Is Active</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-id"><a href="<?php print_link("product/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
                                                    <td class="td-image">
                                                        <span  data-value="<?php echo $data['image']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="image" 
                                                            data-title="Vistazo" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['image']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-barcode">
                                                        <span  data-value="<?php echo $data['barcode']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="barcode" 
                                                            data-title="Escribir  Barcode" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['barcode']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-name">
                                                        <span  data-value="<?php echo $data['name']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="name" 
                                                            data-title="Escribir  Name" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['name']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-description">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="description" 
                                                            data-title="Escribir  Description" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['description']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-inventary_min">
                                                        <span  data-value="<?php echo $data['inventary_min']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="inventary_min" 
                                                            data-title="Escribir  Inventary Min" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['inventary_min']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-price_in">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['price_in']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="price_in" 
                                                            data-title="Escribir  Price In" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['price_in']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-price_out">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['price_out']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="price_out" 
                                                            data-title="Escribir  Price Out" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['price_out']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-unit">
                                                        <span  data-value="<?php echo $data['unit']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="unit" 
                                                            data-title="Escribir  Unit" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['unit']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-presentation">
                                                        <span  data-value="<?php echo $data['presentation']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="presentation" 
                                                            data-title="Escribir  Presentation" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['presentation']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-user_id">
                                                        <span  data-value="<?php echo $data['user_id']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="user_id" 
                                                            data-title="Escribir  User Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['user_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-category_id">
                                                        <span  data-value="<?php echo $data['category_id']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="category_id" 
                                                            data-title="Escribir  Category Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['category_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-created_at">
                                                        <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['created_at']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="created_at" 
                                                            data-title="Escribir  Created At" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['created_at']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-is_active">
                                                        <span  data-value="<?php echo $data['is_active']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="is_active" 
                                                            data-title="Escribir  Is Active" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['is_active']; ?> 
                                                        </span>
                                                    </td>
                                                    <th class="td-btn">
                                                        <a class="btn btn-sm btn-success has-tooltip" title="Ver registro" href="<?php print_link("product/view/$rec_id"); ?>">
                                                            <i class="material-icons">visibility</i> Ver
                                                        </a>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("product/edit/$rec_id"); ?>">
                                                            <i class="material-icons">edit</i> Editar
                                                        </a>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("product/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="??Seguro que quieres borrar este registro?" data-display-style="modal">
                                                            <i class="material-icons">clear</i>
                                                            Borrar
                                                        </a>
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="material-icons">block</i> ning??n record fue encontrado
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <button data-prompt-msg="??Est?? seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("product/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="material-icons">clear</i> Eliminar seleccionado
                                                    </button>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">save</i> Exportar
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
