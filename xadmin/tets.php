<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/21/2017
 * Time: 8:42 PM
 */

?>

<div class="x_content">
    <table id="datatablemasters" class="table table-striped table-bordered hover order-column"
           width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Country Sno</th>
            <th>Country Code</th>
            <th>Country Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($GetCountryData)) {
            foreach ($GetCountryData As $GetCountryDataVal) {


                ?>
                <tr>
                    <td><?= $GetCountryDataVal->CountrySno ?></td>
                    <td><?= $GetCountryDataVal->CountyCode ?></td>
                    <td><?= $GetCountryDataVal->CountryName ?></td>
                    <td>
                        <button type="button" class="btn btn-info btn-xs"
                                onclick="EditCountry(<?= $GetCountryDataVal->CountrySno ?>);"
                                title="Edit Record">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-xs"
                                title="Delete Record"
                                onclick="DeleteCountryData(<?= $GetCountryDataVal->CountrySno ?>);">
                            <i class="fa fa-trash-o"></i> Delete
                        </button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
</div>
