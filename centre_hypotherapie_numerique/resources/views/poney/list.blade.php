<div style="border: 1px solid black;  padding: 15px;justify-content: left;">
    <h3 class="text-xl font-bold mb-4 text-center">Poneys</h3>

    <div >
        @foreach($poneys as $poney)
            <div class="grid grid-cols-15 items-center p-2">
                <span>{{ $poney->name }}</span>
                <span>
                    {{ $poney->work_time }}h sur {{ $poney->max_work_time }}h
                    <br>
                    <progress value="{{ $poney->work_time }}" max="{{ $poney->max_work_time }}"></progress>
                </span>
                <div class="flex space-x-2">
                    <form action="{{ route('poney.edit', $poney->id) }}" method="POST" class="inline">
                        @csrf
                        @method('GET')
                        <button type="submit" class="text-white-600"><i class="fa fa-edit"></i></button>
                    </form>

                    <form action="{{ route('poney.destroy', $poney->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="background-color: #d9534f; margin-left: 10px;"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
