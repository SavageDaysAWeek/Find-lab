    <table class="table align-items-center rounded-lg">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort text-center text-light">Документ</th>
                <th scope="col" class="sort text-center text-light">Университет</th>
                <th scope="col" class="sort text-center text-light d-none d-md-table-cell">Предмет</th>
                <th scope="col" class="sort text-center text-light d-none d-md-table-cell">Курс</th>
                <th scope="col" class="sort text-center text-light d-none d-lg-table-cell">Направление</th>
                <th scope="col" class="sort text-center text-light d-none d-md-table-cell">Стоимость</th>
            </tr>
        </thead>

        <tbody class="list">
            @foreach ($ad_docs as $ad)
            @php
                $doc = $ad->doc;
                if ($doc->type !== $type)
                    continue;
            @endphp
            <tr class="bg-success text-white">
                <th scope="row text-center">
                    <div class="media align-items-center">
                        <a href="/doc/{{ $doc->id }}" class="media-body text-dark text-center">
                            <span class="name mb-0 text-sm">{{ $doc->title }}</span>
                        </a>
                    </div>
                </th>
                <td class="budget text-center">
                    {{ $doc->univer }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ $doc->subject }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ $doc->year }}
                </td>
                <td class="budget text-center d-none d-lg-table-cell">
                    {{ $doc->group }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ ($doc->price) ? $doc->price : 'Не указана' }}
                </td>
            </tr>
            @endforeach

            @if (count($ad_docs) == 0)
            @foreach ($docs as $doc)
            @php
                if (!$doc->isAd($doc->id))
                    continue;
            @endphp
            <tr class="bg-success text-white">
                <th scope="row text-center">
                    <div class="media align-items-center">
                        <a href="/doc/{{ $doc->id }}" class="media-body text-dark text-center">
                            <span class="name mb-0 text-sm">{{ $doc->title }}</span>
                        </a>
                    </div>
                </th>
                <td class="budget text-center">
                    {{ $doc->univer }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ $doc->subject }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ $doc->year }}
                </td>
                <td class="budget text-center d-none d-lg-table-cell">
                    {{ $doc->group }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ ($doc->price) ? $doc->price : 'Не указана' }}
                </td>
            </tr>
            @endforeach
            @endif 
            
            @foreach ($docs as $doc)
            @php
                if ($doc->isAd($doc->id))
                    continue;
            @endphp
            <tr @if ($doc->isAd($doc->id)) class="bg-success text-white" @endif>
                <th scope="row text-center">
                    <div class="media align-items-center">
                        <a href="/doc/{{ $doc->id }}" class="media-body text-dark text-center">
                            <span class="name mb-0 text-sm">{{ $doc->title }}</span>
                        </a>
                    </div>
                </th>
                <td class="budget text-center">
                    {{ $doc->univer }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ $doc->subject }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ $doc->year }}
                </td>
                <td class="budget text-center d-none d-lg-table-cell">
                    {{ $doc->group }}
                </td>
                <td class="budget text-center d-none d-md-table-cell">
                    {{ ($doc->price) ? $doc->price : 'Не указана' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $docs->links() }}
    </div>