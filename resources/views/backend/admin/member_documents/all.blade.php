@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card no-export">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title">{{ _lang('Documents') }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="documents_table" class="table data-table">
                        <thead>
                            <tr>
                                <th>{{ _lang('Member ID') }}</th>
                                <th>{{ _lang('Member Name') }}</th>
                                <th>{{ _lang('Document Name') }}</th>
                                <th>{{ _lang('Document') }}</th>
                                <th>{{ _lang('Uploaded At') }}</th>
                                <th class="text-center">{{ _lang('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($memberdocuments as $doc)
                            <tr data-id="row_{{ $doc->id }}">
                                <td>{{ $doc->member->member_no ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('members.show', $doc->member_id) }}">
                                        {{ $doc->member->first_name ?? '' }} {{ $doc->member->last_name ?? '' }}
                                    </a>
                                </td>
                                <td>{{ $doc->name }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('public/uploads/documents/' . $doc->document) }}">
                                        <i class="ti-file"></i> {{ $doc->document }}
                                    </a>
                                </td>
                                <td>{{ $doc->created_at }}</td>
                                <td class="text-center">
                                    <span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">
                                            {{ _lang('Action') }}
                                        </button>
                                        <form action="{{ route('member_documents.destroy', $doc->id) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <div class="dropdown-menu">
                                                <a href="{{ route('member_documents.edit', $doc->id) }}" data-title="{{ _lang('Update Document') }}" class="dropdown-item ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit') }}</a>
                                                <button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;{{ _lang('Delete') }}</button>
                                            </div>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
