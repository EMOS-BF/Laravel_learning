 <div class="row p-3 pt-4">
    <div class="col-7">
      <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i>Location de chambre</h3>

          <div class="card-tools d-flex align-items-center ">
            <a href="" class="btn btn-primary text-white mr-4 d-block"><i class="fas fa-lon-arrow-alt-left"></i> Retourner vers la liste des chambres</a>
          <button type="button" class="btn btn-primary text-white mr-4 d-block"  ><i class="fas fa-user-plus"></i> Nouveau Tarif</button>
          </div>
        </div>

                <div class="p-4">
                    <div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control">
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-link"> <i class="fa fa-check"></i>
                            Valider</button>
                        <button class="btn btn-link"> <i
                                class="far fa-trash-alt"></i> Annuler</button>
                    </div>
                </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table-striped" >
          <div style="height:350px;">
              <table class="table table-head-fixed">
              <thead>
                  <tr>
                  <th></th>
                  <th >Durée Location</th>
                  <th class="text-center">Prix</th>
                  <th  class="text-center">Action</th>
                  </tr>
              </thead>
              <tbody>
                {{-- @forelse ($tarifs as $tarif) --}}
                <tr>
                    <td></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td>
                        <button type="button" class="btn btn-link" > <i class="far fa-edit"></i> </button>
                    </td>
                </tr>
                    
                {{-- @empty --}}
                <tr>
                    <td colspan="4">
                        <div class="alert alert-danger">

                            <h5><i class="icon fas fa-ban"></i> Information!</h5>
                            La chambre ne dispose pas encore de tarif.
                            </div>
                    </td>
                </tr>   
                {{-- @endforelse --}}
              </tbody>
              </table>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
</div>