<div class="pull-right" style="padding-bottom: 20px"><strong>Jumlah Total PPTKIS :</strong> {{pptkis_q.length}}   </div>
<table st-table="pptkis" st-safe-src="pptkis_q" class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="btn-primary">
            <th class="text-center" style="width:5%">No</th>
            <th class="text-center" style="width:auto">Nama PPTKIS</th>
            <th class="text-center" style="width:20%">Penanggung Jawab</th>
            <th class="text-center" style="width:25%">Telepon / Fax</th>
            <th class="text-center" style="width:20%">No Ijin</th>
            <?php if($this->session->userdata('role') == 1){
            echo '<th class="text-center" style="width:7.5%">Edit</th>
            <th class="text-center" style="width:7.5%">Delete</th>';
            } ?>
        </tr>
        <tr class="text-center">
            <th></th>
            <th><input st-search="ppnama" placeholder="nama pptkis" class="input-sm form-control" type="search"/></th>
            <th><input st-search="pppngjwb" placeholder="penanggung jawab" class="input-sm form-control" type="search"/></th>
            <th><input st-search="pptelp || ppfax" placeholder="telepon" class="input-sm form-control" type="search"/></th>
            <th><input st-search="ppijin" placeholder="ijin" class="input-sm form-control" type="search"/></th>
            <?php if($this->session->userdata('role') == 1){
            echo '<th></th>
            <th></th>';
            } ?>
        </tr>
    </thead>
    <tbody class="table-hover " >
        <tr ng-repeat="pt in pptkis" ng-cloak>
            <td class="text-center">{{pt.index}}</td>
            <td ><a ng-click="detail_pptkis(pt.ppkode)" style="cursor: pointer">{{pt.ppnama}}</a></td>
            <td >{{pt.pppngjwb}}</td>
            <td class="text-center">{{pt.pptelp}} / {{pt.ppfax}}</td>
            <td class="text-center">{{pt.ppijin}}</td>
            <?php if($this->session->userdata('role') == 1){
            echo '<td><div class="center-button"><a href="'.base_url().'AgensiPPTKIS/editPPTKIS/{{pt.ppkode}}"><button class="btn btn-info" type="button" name="button">Edit</button></a></div></td>
            <td>
              <div class="center-button"><a href="'.base_url().'AgensiPPTKIS/deletePPTKIS/{{pt.ppkode}}"><button class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
            </td>';
            } ?>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" class="text-center">
                <div st-pagination="" st-items-by-page="10" st-template="<?php echo assets_url() ?>/template/custom.pagination.html"></div>
            </td>
        </tr>

    </tfoot>
</table>
