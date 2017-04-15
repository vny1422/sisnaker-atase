				<div id="windowModal" class="modal modal-wide fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				 	<div class="modal-dialog modal-lg">
				    	<div class="modal-content">
				      		<div class="modal-header">
			                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
			                    <button type="button" class="btn btn-success pull-right" id="Adownloadform" value="177777">
			                    	<i class="fa fa-download"></i> 
			                    	Download Formulir
			                    </button>
			                    <h3 class="modal-title"><strong>Data Detail Kasus</strong></h3>
			                </div>
			                <form action="" class="form-horizontal">
				                <div class="modal-body">
				                	<div class="panel panel-default" id="casesiap">
				                		<div class="panel-heading">
		                					<img class="img-rounded img-responsive" alt="" src="<?php echo assets_url()?>images/sisnaker.png">
		                				</div>		                				 
		                				<div class="panel-body">
		                					<div class="form-group">
												<label for="inputpaspor" class="col-sm-3 control-label">Perihal :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="perihal"></p>                								
												</div>
											</div>
											<div class="form-group">
												<label for="inputpaspor" class="col-sm-3 control-label">Pesan Disposisi :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="pesandisposisi"></p>       								
												</div>                							
											</div>
											<div class="form-group">
												<label for="inputpaspor" class="col-sm-3 control-label">Berkas :</label>
												<div class="col-sm-3">
													<div>
														<a href="#" target="_blank" class="btn btn-primary" id="filesiap">
															<i class="fa fa-download"></i> <strong>Download Berkas Disposisi</strong>
														</a>
													</div>   								
												</div>                							
											</div>
		                				</div> 
				                	</div>
				                	<div class="panel panel-default">
		                				<div class="panel-heading">
		                					<h3 class="panel-title"><strong>Informasi TKI</strong></h3>
		                				</div>
		                				
									  	<div class="panel-body">
									  		<div class="form-group">
									  			<label for="inputpaspor" class="col-sm-3 control-label">No. Paspor :</label>
									  			<div class="col-sm-4">
													<p class="form-control-static" id="Ainputpaspor" name="paspor"></p>
									  			</div>
									  		</div>
									  		
									  		<div class="form-group">
												<label for="inputnamebmi" class="col-sm-3 control-label">Nama TKI :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="Anamebmi" name="namebmi"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputgender" class="col-sm-3 control-label">Jenis Kelamin :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Ajk" name="jk"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputarc" class="col-sm-3 control-label">No. ARC :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Aarc" name="arc"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputtglmasuktw" class="col-sm-3 control-label">No. Telepon / Handphone :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Aphone" name="phone"></p>
												</div>
											</div>
																					
											<div class="form-group">
												<label for="inputworktype" class="col-sm-3 control-label">Jenis Pekerjaan :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Ajenispekerjaan" name="jenispekerjaan"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputworksector" class="col-sm-3 control-label">Status TKI :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Astatustki" name="statustki"></p>
												</div>
											</div>	                			
									  	</div>							  
									</div>
		                			
		                			
		                			<div class="panel panel-default">
		                				<div class="panel-heading">
		                					<h3 class="panel-title"><strong>Informasi Agensi dan Majikan TKI</strong></h3>
		                				</div>
		                				<div class="panel-body">
		                					<div class="form-group">
												<label for="inputagensitw" class="col-sm-3 control-label">Nama Agensi :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="Aagensitw" name="agensitw"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputcpagensitw" class="col-sm-3 control-label">CP Agensi :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="Acpagensitw" name="cpagensitw"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputhpagensitw" class="col-sm-3 control-label">Telp. Agensi :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Ahpagensitw" name="hpagensitw"></p>								
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputpptkis" class="col-sm-3 control-label">Nama PPTKIS :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="Apptkis" name="pptkis"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputmajikan" class="col-sm-3 control-label">Nama Majikan :</label>
												<div class="col-sm-8">
													<p class="form-control-static" id="Amajikan" name="majikan"></p>
												</div>
											</div>				                			
				                			
		                				</div>							  
									</div>
									
		                			<div class="panel panel-default">
		                				<div class="panel-heading">
		                					<h3 class="panel-title"><strong>Informasi Petugas Penanganan</strong></h3>
		                				</div>
									  	<div class="panel-body">
											<div class="form-group">
												<label for="inputworksector" class="col-sm-3 control-label">Organisasi :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Aorganisasi" name="organisasi"></p>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputworksector" class="col-sm-3 control-label">Nama Petugas :</label>
												<div class="col-sm-4">
													<p class="form-control-static" id="Apetugaspenanganan" name="petugaspenanganan"></p>
												</div>
											</div>
									  	</div>
									</div>
		                			               
		                			<div class="panel panel-default">
		                				<div class="panel-heading">
		                					<h3 class="panel-title"><strong>Informasi Administrasi Kasus</strong></h3>
		                				</div>
									  	<div class="panel-body">
									  		<div class="form-group">
											<label class="col-sm-3 control-label">No. Kasus :</label>
											<div class="col-sm-8">
												<p class="form-control-static" id="Anomorkasus" name="nomorkasus"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputpelapor" class="col-sm-3 control-label">Nama Pelapor :</label>
											<div class="col-sm-8">
												<p class="form-control-static" id="Apelapor" name="pelapor"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputtglmasuktw" class="col-sm-3 control-label">No. Telp. Pelapor :</label>
											<div class="col-sm-4">
												<p class="form-control-static" id="Atlppelapor" name="tlppelapor"></p>							
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputtglmasuktw" class="col-sm-3 control-label">Tanggal Pengaduan :</label>
											<div class="col-sm-4">
												<p class="form-control-static" id="Atglpengaduan" name="tglpengaduan"></p>							
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputworksector" class="col-sm-3 control-label">Media Pengaduan :</label>
											<div class="col-sm-4">
												<p class="form-control-static" id="Amedia" name="media"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputworksector" class="col-sm-3 control-label">Klasifikasi Pengaduan :</label>
											<div class="col-sm-4">
												<p class="form-control-static" id="Aklasifikasikasus" name="klasifikasikasus"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputpelapor" class="col-sm-3 control-label">Deskripsi Permasalahan :</label>
											<div class="col-sm-8">
												<p class="form-control-static" id="Apermasalahan" name="permasalahan"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputpelapor" class="col-sm-3 control-label">Tuntutan :</label>
											<div class="col-sm-8">
												<p class="form-control-static" id="Atuntutan" name="tuntutan"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputpelapor" class="col-sm-3 control-label">Penyelesaian Permasalahan :</label>
											<div class="col-sm-8">
												<p class="form-control-static" id="Atindaklanjut" name="tindaklanjut"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputtglmasuktw" class="col-sm-3 control-label">Nominal Yang Diselamatkan (<?php echo $namacurrency ?>) :</label>
											<div class="col-sm-4">
												<p class="form-control-static" id="Anominal" name="nominal"></p>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputworksector" class="col-sm-3 control-label">Status Permasalahan :</label>
											<div class="col-sm-3">
												<p class="form-control-static" id="Astatusmasalah" name="statusmasalah"></p>
											</div>
										</div>
				                			
				                			<div class="form-group">
				                				<label class="col-sm-3 control-label">Berkas Kasus :</label>
				                				<div class="col-sm-8">
				      								<table class="table table-striped table-bordered table-hover" id="tablefile">	                							
					                        		<tbody id="berkaskasus">
		                							</tbody>
	                						</table>
				    							</div>
				                			</div>
									  	</div>
									</div>	                			
				                </div>
				                <div class="modal-footer">
				                    <button type="button" class="btn btn-default" data-dismiss="modal">
				                    	<i class="fa fa-power-off"></i> <strong>Close</strong>
				                    </button>
				                    <button type="button" class="btn btn-primary" id="editkasus">
				                    	<i class="fa fa-pencil"></i> <strong>Edit</strong>
				                    </button>
				                    <button type="button" class="btn btn-danger" id="delkasus" ng-click="delKasus()">
				                    	<i class="fa fa-trash-o"></i> <strong>Hapus</strong>
				                    </button>
				                </div>
			                </form>
				    	</div>
				  	</div>
				</div>