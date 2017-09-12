<div class="pull-right" style="padding-bottom: 20px"><strong>Jumlah Total Agensi Tercekal :</strong> {{cekalagencies_q.length}}   </div>
<table st-table="cekalagencies" st-safe-src="cekalagencies_q" class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="btn-primary">
            <th class="text-center" style="width:5%">No</th>
            <th class="text-center" style="width:auto">Nama Agensi</th>
            <th class="text-center" style="width:20%">Penanggung Jawab</th>
            <th class="text-center" style="width:15%">Awal Cekal</th>
            <th class="text-center" style="width:15%">Akhir Cekal</th>
        </tr>
        <tr class="text-center">
            <th></th>
            <th><input st-search="agnama" placeholder="nama agensi" class="input-sm form-control" type="search"/></th>
            <th><input st-search="agpngjwb" placeholder="penanggung jawab" class="input-sm form-control" type="search"/></th>
            <th><input st-search="castart" placeholder="awal cekal" class="input-sm form-control" type="search"/></th>
            <th><input st-search="caend" placeholder="akhir cekal" class="input-sm form-control" type="search"/></th>
        </tr>
    </thead>
    <tbody class="table-hover " >
        <tr ng-repeat="agen in cekalagencies" ng-cloak>
            <td class="text-center">{{agen.index}}</td>
            <td ><a ng-click="detail_agency(agen.agid)" style="cursor: pointer">{{agen.agnama}} </br> {{agen.agnamaoth}}</a></td>
            <td class="text-center">{{agen.agpngjwb}} </br> {{agen.agpngjwboth}}</td>
            <td class="text-center">{{agen.castart}}</td>
            <td class="text-center">{{agen.caend || "-" }}</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-center">
                <div st-pagination="" st-items-by-page="10" st-template="<?php echo assets_url() ?>/template/custom.pagination.html"></div>
            </td>
        </tr>

    </tfoot>
</table>
