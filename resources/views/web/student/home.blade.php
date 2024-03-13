@extends('template.template2')

@section('active-home')
	class="active"
@endsection

@section('content')
	<section class="section-home">
		<div
			style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; flex-wrap: true">
			<h1>Minha Inscrição</h1>

			@if ($lastEnrollmentPeriod->end > date('Y-m-d'))
				@if ($movements->count() < 5)
					@if ($lastEnrollment->semestre === $lastEnrollmentPeriod->semestre)
						<p
							style="width: 50%; background-color: #1900ff2c; color: #1900ff; border-radius:5px; padding:4px 8px; font-size:12px;margin:0">
							Olá <span style="color: #000; font-weight: bold" class="">
								Sr(a)
								{{ $student->last_name }}</span>, você já está inscrito nesse semestre! Clique no
							botão a seguir para baixar o documento de inscrição.<a
								class="hover:border-1 ml-2 rounded-sm border-blue-900 bg-blue-700 px-1 py-0.5 text-white hover:bg-opacity-25 hover:text-blue-950"
								href=" {{ url('/printer/recipient-inscription/' . $student->code . '/' . $lastEnrollment->id) }}">Baixar</a>
						</p>
					@else
						<a id="novaInscricaoLink" class="novaInscricaoLink"
							href="{{ route('enrollment-store') }}" style="">Nova
							Inscrição</a>
					@endif
				@else
					<p
						style="width: 50%; background-color: #ff88002c; color: #ff8800; border-radius:5px; padding:4px 8px; font-size:12px;margin:0">
						Olá <span style="color: #000; font-weight: bold"> Sr(a)
							{{ $student->last_name }}</span>, resguralize sua situacao financeira referente
						ao(s) semestre(s) passado(s) para poder
						fazer inscricao deste semestre!</p>
				@endif
			@endif
			<form id="enrollmentform" style="display: none" action="{{ route('enrollment-store') }}"
				method="post"
				class="absolute left-0 top-0 flex h-full w-full flex-col items-center justify-center rounded-md bg-blue-900 bg-opacity-40 p-2">
				@csrf
				<div class="flex w-[40rem] flex-col gap-2 rounded-md bg-white">
					<div class="flex h-12 items-center rounded-md bg-sky-200 px-4 text-sky-900">
						<span class="text-2xl">Nova inscrição</span>
					</div>
					<div class="mb-2 flex w-full flex-col gap-2 border-2 p-2 px-4">
						<span>Serviço</span>
						<select name="taxa" id="taxa"
							class="h-8 w-full border-2 border-blue-400 outline-none" required>
							<option value="1000">Taxa de inscrição por disciplina (Nacional)</option>
							<option value="1200">Taxa de inscrição por disciplina (Estrangeiro)</option>
						</select>
					</div>
					<div class="mb-2 flex w-full flex-col gap-2 border-2 p-2 px-4">
						<span>Número de displinas</span>
						<input type="number" name="number"
							class="h-8 w-full border-2 border-blue-400 px-2 outline-none" min="1"
							max="9" required>
					</div>
					<div class="mb-2 flex w-full flex-row justify-between gap-2 border-2 p-2 px-4">
						<button id="enrollmentCancel" type="button"
							class="rounded-md bg-red-700 px-4 text-xl text-white hover:bg-opacity-50">Cancel</button>
						<button type="submit"
							class="rounded-md bg-green-700 px-4 text-xl text-white hover:bg-opacity-50">Confirmar</button>
					</div>

				</div>
			</form>
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
						<a
							href="{{ url('/printer/recipient-inscription/' . $enrollment->student->code . '/' . $enrollment->id) }}">
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
				document.getElementById('enrollmentform').style.display = 'flex';
			}
		});
		document.getElementById('enrollmentCancel').addEventListener('click', function(event) {
			event.preventDefault(); // Evita a execução do link diretamente

			document.getElementById('enrollmentform').style.display = 'none';

		});
	</script>
@endsection
