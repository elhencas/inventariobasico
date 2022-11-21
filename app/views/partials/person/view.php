<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Ver</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-image">
                                        <th class="title"> Image: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['image']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
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
                                    </tr>
                                    <tr  class="td-name">
                                        <th class="title"> Name: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
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
                                    </tr>
                                    <tr  class="td-lastname">
                                        <th class="title"> Lastname: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['lastname']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="lastname" 
                                                data-title="Escribir  Lastname" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['lastname']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-company">
                                        <th class="title"> Company: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['company']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="company" 
                                                data-title="Escribir  Company" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['company']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-address1">
                                        <th class="title"> Address1: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['address1']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="address1" 
                                                data-title="Escribir  Address1" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['address1']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-address2">
                                        <th class="title"> Address2: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['address2']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="address2" 
                                                data-title="Escribir  Address2" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['address2']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-phone1">
                                        <th class="title"> Phone1: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['phone1']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="phone1" 
                                                data-title="Escribir  Phone1" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['phone1']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-phone2">
                                        <th class="title"> Phone2: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['phone2']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="phone2" 
                                                data-title="Escribir  Phone2" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['phone2']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-email1">
                                        <th class="title"> Email1: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['email1']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="email1" 
                                                data-title="Escribir  Email1" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['email1']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-email2">
                                        <th class="title"> Email2: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['email2']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="email2" 
                                                data-title="Escribir  Email2" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['email2']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kind">
                                        <th class="title"> Kind: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['kind']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="kind" 
                                                data-title="Escribir  Kind" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['kind']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-created_at">
                                        <th class="title"> Created At: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['created_at']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("person/editfield/" . urlencode($data['id'])); ?>" 
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
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("person/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Editar
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("person/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                                    <i class="material-icons">clear</i> Borrar
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="material-icons">block</i> ningún record fue encontrado
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>