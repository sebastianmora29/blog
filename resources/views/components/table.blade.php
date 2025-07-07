<div class="relative overflow-x-auto bg-[#171717] rounded-md shadow-sm">
    <table class="w-full text-sm text-left rtl:text-right text-gray-300">
        <thead class="text-xs text-gray-400 uppercase bg-[#1f1f1f]">
            <tr>
                {{ $header }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
