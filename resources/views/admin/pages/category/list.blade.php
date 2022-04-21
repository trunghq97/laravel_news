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
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hiển thị Home</th>
                    <th class="column-title">Kiểu hiển thị</th>
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
                            $name               = Highlight::show($val['name'], $params['search'], 'name');
                            $status             = Template::showItemStatus($controllerName, $id, $val['status']);
                            $isHome             = Template::showItemIsHome($controllerName, $id, $val['is_home']);
                            $display            = Template::showItemSelect($controllerName, $id, $val['display'], 'display');
                            $createdHistory     = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory    = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listButtonAction   = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $class }} pointer">
                            <td>{{ $index }}</td>
                            <td width="25%">{!! $name !!}</td>
                            <td>{!! $status !!}</td>
                            <td>{!! $isHome !!}</td>
                            <td>{!! $display !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td>
                            <td class="last">{!! $listButtonAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>