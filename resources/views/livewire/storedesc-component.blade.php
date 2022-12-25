<div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Write Description</h3>
        </div>

        <div class="card-body">
            @if ($message)
            <br><span  class="text-success" style="font-size: 11.5px;">{{ $message }}</span>
            @endif

            <form wire:submit.prevent="storeDesc">
                <textarea wire:model="desc" name="desc" class="form-control" id="desc" cols="20" rows="5"></textarea>
                @error('desc')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                @enderror
                <br><button style="width:100px; margin:0 auto" type="submit" class="btn btn-block btn-primary">Submit</button>
             </form>
        </div>
    </div> <!-- /.card -->
</div>
