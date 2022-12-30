 
 <div wire:ignore.self>

    {{-- @if($currentPage == CHAMBREADDFORM)
         @include("livewire.chambres.add")
    @endif
  
    @if($currentPage == CHAMBREEDITFORM)
        @include("livewire.chambres.edit")
    @endif
  
    @if($currentPage == CHAMBRELIST)
        @include("livewire.chambres.liste")
    @endif  --}}
  
    @include("livewire.chambres.add")
    @include("livewire.chambres.edit")
    @include("livewire.chambres.liste") 
  </div>
 
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
             const chambre_id = event.detail.message.data.chambre_id
             if(chambre_id){
                 @this.deleteChambre(chambre_id)
             }
         }
         })
     })
 
 </script>
 
 <script>
     window.addEventListener("showModal()", event=>{
        $("#modalAdd").modal({
            "show": true,
            "backdrop": "static"
        })
     })
     window.addEventListener("closeModal", event=>{
        $("#modalAdd").modal("hide")
     })
 
     window.addEventListener("showEditModal", event=>{
        $("#editModal").modal({
            "show": true,
            "backdrop": "static"
        })
     })
     window.addEventListener("closeEditModal", event=>{
        $("#editModal").modal("hide")
     })
 
 </script>
 