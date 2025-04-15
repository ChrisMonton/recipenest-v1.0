
    console.log("Show livewire");
    console.log(Livewire);


// import Swal from 'sweetalert2'


function confirmDeleteReview(review_id){
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {


            if (result.isConfirmed) {
                // Trigger Livewire delete action
                // Livewire.dispatch('review-destroy', review_id);
                Livewire.dispatch('review-list', review_id);
            }


        //   Swal.fire({
        //     title: "Deleted!",
        //     text: "Your file has been deleted.",
        //     icon: "success"
        //   });
        }
      });
}


