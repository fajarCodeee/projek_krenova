@if ($model::find($id)->hasMedia('fotokopi_identitas'))
    <div
        class="flex items-center space-x-2 p-4 bg-white shadow-md rounded-lg border dark:bg-gray-800 dark:border-gray-700">

        <a href="{{ $model::find($id)->getFirstMediaUrl('fotokopi_identitas') }}" target="_blank" rel="noopener noreferrer"
            class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
            Lihat Identitas Peserta
        </a>
    </div>
@else
    <div
        class="p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 dark:bg-yellow-900 dark:border-yellow-600 dark:text-yellow-300">
        <p class="font-medium">Belum ada surat pernyataan yang diupload.</p>
    </div>
@endif
