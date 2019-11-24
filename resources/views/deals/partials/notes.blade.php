<div class="mt-8">
    <h3 class="text-lg text-gray-700 font-normal mb-3">General Notes</h3>


    @can('manageDeal', $deal)
        <form action="#" method="post">
            @csrf

            <textarea
                class="card w-full mb-4 justify-start form-textarea mt-1 outline-none focus:border focus:border-gray-300 text-gray-800 text-sm leading-relaxed"
                name="body"
                cols="30" rows="10"
                placeholder="- Some hocus pocus notes..."></textarea>

            <input type="hidden" name="user_id" value="{!! auth()->id() !!}">

            <button type="submit" class="btn btn-success">Save</button>
        </form>

        @include('errors')
    @endcan

</div>
