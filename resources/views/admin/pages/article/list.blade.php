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
                    <th class="column-title">Article Info</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Category</th>
                    <th class="column-title">Kiểu bài viết</th>
                    <th class="column-title">Trạng thái</th>
                    {{-- <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th> --}}
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
                            $thumb              = Template::showItemThumb($controllerName, $val['thumb'], $val['name']);
                            $categoryName       = $val['category_name'];
                            $status             = Template::showItemStatus($controllerName, $id, $val['status']);
                            $type               = Template::showItemSelect($controllerName, $id, $val['type'], 'type');
                            $content            = Highlight::show($val['content'], $params['search'], 'content');
                            // $createdHistory     = Template::showItemHistory($val['created_by'], $val['created']);
                            // $modifiedHistory    = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listButtonAction   = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $class }} pointer">
                            <td>{{ $index }}</td>
                            <td width="30%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Content:</strong> {!! $content !!}</p>
                            </td>
                            <td width="14%"><p>{!! $thumb !!}</p></td>
                            <td>{!! $categoryName !!}</td>
                            <td>{!! $type !!}</td>
                            <td>{!! $status !!}</td>
                            {{-- <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td> --}}
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