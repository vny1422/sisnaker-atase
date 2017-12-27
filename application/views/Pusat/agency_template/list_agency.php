<div class="pull-right" style="padding-bottom: 20px"><strong>Jumlah Total Agensi :</strong> {{agencies_q.length}}   </div>
<table st-table="agencies" st-safe-src="agencies_q" class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="btn-primary">
            <th class="text-center" style="width:5%">No</th>
            <th class="text-center" style="width:auto">Nama Agensi</th>
            <th class="text-center" style="width:auto">Institution</th>
            <th class="text-center" style="width:15%">Penanggung Jawab</th>
            <th class="text-center" style="width:25%">Telp / Fax</th>
            <th class="text-center" style="width:20%">No Ijin</th>
            <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
            echo '<th class="text-center" style="width:7.5%">Edit</th>
            <th class="text-center" style="width:7.5%">Delete</th>';
            } ?>
        </tr>
        <tr class="text-center">
            <th></th>
            <th><input st-search="agnama" placeholder="nama agensi" class="input-sm form-control" type="search"/></th>
            <th><input st-search="nameinstitution" placeholder="institution" class="input-sm form-control" type="search"/></th>
            <th><input st-search="agpngjwb" placeholder="penanggung jawab" class="input-sm form-control" type="search"/></th>
            <th><input st-search="agtelp" placeholder="telepon" class="input-sm form-control" type="search"/></th>
            <th><input st-search="agnoijincla" placeholder="no ijin" class="input-sm form-control" type="search"/></th>
            <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
            echo '<th></th>
            <th></th>';
            } ?>
        </tr>
    </thead>
    <tbody class="table-hover " >
        <tr ng-repeat="agen in agencies" ng-cloak>
            <td class="text-center">{{agen.index}}</td>
            <td ><a ng-click="detail_agency(agen.agid)" style="cursor: pointer">{{agen.agnama}} </br> {{agen.agnamacn}}</a></td>
            <td class="text-center">{{agen.nameinstitution}}</td>
            <td class="text-center">{{agen.agpngjwb}} </br> {{agen.agpngjwboth}}</td>
            <td class="text-center">{{agen.agtelp}} / {{agen.agfax}}</td>
            <td class="text-center">{{agen.agnoijincla}}</td>
            <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
            echo '<td><div class="center-button"><a href="'.base_url().'AgensiPPTKIS/editAgensi/{{agen.agid}}"><button class="btn btn-info" type="button" name="button">Edit</button></a></div></td>
            <td>
              <div class="center-button"><a href="'.base_url().'AgensiPPTKIS/deleteAgensi/{{agen.agid}}"><button class="btn btn-danger" type="button" name="button">Hapus</button></a></div>
            </td>';
            } ?>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <div st-pagination="" st-items-by-page="10" st-template="<?php echo assets_url() ?>/template/custom.pagination.html"></div>
            </td>
        </tr>

    </tfoot>
</table>
