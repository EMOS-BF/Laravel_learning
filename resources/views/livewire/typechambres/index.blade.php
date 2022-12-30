<div>
    
    <div class="row p-4 pt-5">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-gradient-primary d-flex align-items-center">
              <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Type de chambre</h3>
      
              <div class="card-tools d-flex align-items-center ">
              <a class="btn btn-link text-white mr-4 d-block" wire:click="toggleShowAddTypeChambreForm" ><i class="fas fa-user-plus"></i> Nouveau type de chambre</a>
                <div class="input-group input-group-md" style="width: 250px;">
                  <input type="text" name="table_search" wire:model.debounce.250ms="search" class="form-control float-right" placeholder="Search">
      
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
              <table class="table table-head-fixed">
                <thead>
                  <tr>
                    <th style="width:50%;">Type de chambre</th>
                    <th style="width:20%;" class="text-center">Ajouté</th>
                    <th style="width:30%;" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($isAddTypeChambre)
                            <tr>
                                <td colspan="2">
                                    <input type="text"
                                    wire:keydown.enter="addNewTypeChambre"
                                    class="form-control @error('newTypeChambreName') is-invalid @enderror"
                                    wire:model="newTypeChambreName" />
                                    @error('newTypeChambreName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="addNewTypeChambre"> <i class="fa fa-check"></i> Valider</button>
                                    <button class="btn btn-link" wire:click="toggleShowAddTypeChambreForm"> <i class="far fa-trash-alt"></i> Annuler</button>
                                </td>
                            </tr>
                        @endif
                  @foreach ($typechambres as $typechambre )
                      <tr>
                        <td>{{ $typechambre->Description }}</td>
                        <td>{{ optional($typechambre->created_at)->diffForHumans() }}</td>
                        <td class="text-center">
                            <button class="btn btn-link" wire:click= "editTypeChambre({{$typechambre->id}})"> <i class="far fa-edit"></i> </button>
                            <button class="btn btn-link" wire:click = "confirmDelete('{{$typechambre->Description}}', {{$typechambre->id}})"><i class="far fa-trash-alt"></i> </button>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                 {{$typechambres->links()}}
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
            

</div>

<script>
  window.addEventListener("showEditForm",function(e){
      Swal.fire({
          title: "Edition d'un type de chambre",
          input: 'text',
          inputValue: e.detail.typechambre.nom ,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText:'Modifier <i class="fa fa-check"></i>',
          cancelButtonText:'Annuler <i class="fa fa-times"></i>',
          inputValidator: (value) => {
              if (!value) {
              return 'Champ obligatoire'
              }

              @this.updateTypeChambre(e.detail.typechambre.id, value)
          }
      })
  })
</script>

<script>
  window.addEventListener("showSuccessMessage", event=>{
      Swal.fire({
              position: 'top-end',
              icon: 'success',
              toast:true,
              title: event.detail.message || "Opération effectuée avec succès!",
              showConfirmButton: false,
              timer: 5000
              }
          )
  })
</script>

<script>
  window.addEventListener("showConfirmMessage", event=>{
     Swal.fire({
      title: event.detail.message.title,
      text: event.detail.message.text,
      icon: event.detail.message.type,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Continuer',
      cancelButtonText: 'Annuler'
      }).then((result) => {
      if (result.isConfirmed) {
          if(event.detail.message.data.type_chambre_id){
              @this.deleteTypeChambre(event.detail.message.data.type_chambre_id)
          }

          /*if(event.detail.message.data.propriete_id){
              @this.deleteProp(event.detail.message.data.propriete_id)
          }*/
      }
      })
  })

</script>