@if (count($siswa) > 0)
    @foreach ($siswa as $k => $v)
        <tr>
            <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{ $k + 1 }}</p>
            </td>
            <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{ $v->nis }}</p>
            </td>
            <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{ $v->nama }}</p>
            </td>
            <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{ $v->username }}</p>
            </td>
            <td class="border-bottom-0">
                <a href="{{ route('siswa.edit',$v->nis) }}" class="text-muted">
                    <u>
                        <p class="mb-0 fw-normal">Lihat</p>
                    </u>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">Tidak Ada Data</td>
    </tr>
@endif
