
@extends("theme/$theme/layout")

@section('contenido')
  
     <template v-if="menu==0">
          <inicio></inicio>
     </template>


     <template v-if="menu==1">
          <pregunta></pregunta>
     </template>
@endsection