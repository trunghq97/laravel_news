@php
    use App\Helpers\Template as Template;
    use App\Helpers\Highlight as Highlight;
@endphp

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Link</th>
                    <th class="column-title">Source</th>
                    <th class="column-title">Ordering</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>

                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index              = $key + 1;
                            $class              = ($index % 2 == 0) ? 'even' : 'odd';
                            $id                 = $val['id'];
                            $ordering           = Template::showItemOrdering($controllerName, $val['ordering'], $val['id']);
                            $source             = $val['source'];
                            $name               = Highlight::show($val['name'], $params['search'], 'name');
                            $link               = Highlight::show($val['link'], $params['search'], 'link');
                            $status             = Template::showItemStatus($controllerName, $id, $val['status']);
                            $createdHistory     = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory    = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listButtonAction   = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $class }} pointer">
                            <td>{{ $index }}</td>
                            <td>{{ $name }}</td>
                            <td>{{ $link }}</td>
                            <td>{{ $source }}</td>
                            <td>{!! $ordering !!}</td>
                            <td>{!! $status !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td>
                            <td class="last">{!! $listButtonAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 9])
                @endif
            </tbody>
        </table>
    </div>
</div>