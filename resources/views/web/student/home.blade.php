@extends('template.template2')

@section('active-home') class="active" @endsection

@section('content')

    <section class="section-home">
        <h1>Minha Inscrição</h1>
        <div style="border-bottom: 1px solid #cccccc; margin: 20px 0"></div>
        <table class="table-registration">
            <tr>
                <th>Código do estudante</th>
                <th>Local de Estudo</th>
                <th>Faculdade</th>
                <th>Curso</th>
                <th>Estado de Inscrição</th>
                <th>Acção</th>
            </tr>
            <tr>
                <td>{{ $student->code }}</td>
                <td>{{ $student->studentEnrollment->extension->city }}</td>
                <td>{{ $student->studentEnrollment->faculty->label }}</td>
                <td>{{ $student->studentEnrollment->course->label }}</td>
                <td>
                    @if ($student->registration_status == '2')
                        <span style="padding: 5px; background-color: green; border-radius: 3px; font-size: 10pt; color: #ffffff;">aprovada</span>
                    @elseif($student->registration_status == '1')
                        <span style="padding: 5px; background-color: orange; border-radius: 3px; font-size: 10pt; color: #ffffff;">pendente</span>
                    @else
                        <span style="padding: 5px; background-color: red; border-radius: 3px; font-size: 10pt; color: #ffffff;">rejeitada</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/printer/recipient-inscription/'. $student->code) }}">
                        <i class="bi bi-printer"></i>
                    </a>
                </td>
            </tr>
        </table>
        <div class="div-100" style="margin-top: 20px;">
            <h3 style="font-weight: 400;">Linha de Pesguisa</h3>
            <div style="border-bottom: 1px solid #cccccc; margin: 15px 0"></div>
            <p>{{ $student->studentEnrollment->sewingLine->label }}.</p>
        </div>  
    </section>
@endsection