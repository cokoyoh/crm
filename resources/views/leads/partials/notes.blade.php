<div class="mt-8">
    <h3 class="text-lg text-gray-700 font-normal mb-3">General Notes</h3>

    <form action="#" method="post">
        @method('patch')
        @csrf

        <textarea
            class="card w-full mb-4 justify-start form-textarea mt-1"
            name="notes"
            cols="30" rows="15"
            placeholder="- Some hocus pocus notes..."></textarea>

        <button type="submit" class="btn btn-success">Save</button>
    </form>

    @include('errors')

</div>
