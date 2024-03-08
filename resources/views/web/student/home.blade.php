@extends('template.template2')

@section('active-home')
	class="active"
@endsection

@section('content')
	<section class="section-home">
		<div
			style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; flex-wrap: true">
			<h1>Minha Inscrição</h1>
			{{-- {{ dd($lastEnrollmentPeriod->end) }} --}}
			@if ($lastEnrollmentPeriod->end > date('Y-m-d'))
				@if ($movements->count() < 5)
					@if ($lastEnrollment->semestre === $lastEnrollmentPeriod->semestre)
						<p
							style="width: 50%; background-color: #1900ff2c; color: #1900ff; border-radius:5px; padding:4px 8px">
							Olá <span style="color: #000; font-weight: bold"> Sr(a)
								{{ $student->last_name }}</span>,você já está inscrito nesse semestre!</p>
					@else
						<a id="novaInscricaoLink" class="novaInscricaoLink"
							href="{{ route('enrollment-store') }}" style="">Nova
							Inscrição</a>
					@endif
				@else
					<p
						style="width: 50%; background-color: #ff88002c; color: #ff8800; border-radius:5px; padding:4px 8px">
						Olá <span style="color: #000; font-weight: bold"> Sr(a)
							{{ $student->last_name }}</span>,
						resguralize sua situacao financeira para poder
						fazer inscricao deste semestre!</p>
				@endif
			@endif

		</div>

		<div style="border-bottom: 1px solid #cccccc; margin: 20px 0"></div>
		<table class="table-registration">
			<tr>
				<th>Código do estudante</th>
				<th>Local de Estudo</th>
				<th>Faculdade</th>
				<th>Curso</th>
				<th>Semestre</th>
				<th>Estado de Inscrição</th>
				<th>Acção</th>
			</tr>
			@foreach ($enrollments as $enrollment)
				<tr>
					<td>{{ $student->code }}</td>
					<td>{{ $student->studentEnrollment->extension->city }}</td>
					<td>{{ $enrollment->faculty->label }}</td>
					<td>{{ $enrollment->course->label }}</td>
					<td>{{ $enrollment->semestre }}º</td>
					<td>
						@if ($enrollment->enrollment_status == '2')
							<span
								style="padding: 5px; background-color: green; border-radius: 3px; font-size: 10pt; color: #ffffff;">aprovada</span>
						@elseif($enrollment->enrollment_status == '1')
							<span
								style="padding: 5px; background-color: orange; border-radius: 3px; font-size: 10pt; color: #ffffff;">pendente</span>
						@else
							<span
								style="padding: 5px; background-color: red; border-radius: 3px; font-size: 10pt; color: #ffffff;">rejeitada</span>
						@endif
					</td>
					<td>
						<a href="{{ url('/printer/recipient-inscription/' . $enrollment->student->code) }}">
							<i class="bi bi-printer"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</table>
		<div class="div-100"
			style="margin-top: 50px; border-top: 1px solid #cccccc; padding:14px 0">
			<h3 style="font-weight: bold;font-size: 17px; margin: 4px 0">Linha de Pesquisa</h3>

			<p style="font-size: 14px; font-weight: normal">
				{{ $enrollment->sewingLine->label }}.</p>
		</div>
	</section>
@endsection
@section('javascript')
	<script>
		document.getElementById('novaInscricaoLink').addEventListener('click', function(event) {
			event.preventDefault(); // Evita a execução do link diretamente

			if (confirm('Deseja realmente criar uma nova inscrição?')) {
				window.location.href = this.getAttribute(
					'href'); // Redireciona para a rota
			}
		});
	</script>
@endsection
