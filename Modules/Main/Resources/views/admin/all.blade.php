@component('admin.layouts.content', ['title' => 'Module Controller'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item">Modules List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modules</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @foreach ($modules as $module)
                            @php
                                $moduleData = new \Nwidart\Modules\Json($module->getPath() . '\module.json');
                            @endphp

                            <div class="col-sm-2">

                                <div class="mt-3">
                                    <h4>{{ $moduleData->get('alias') }}</h4>
                                </div>
                                <div>
                                    <p>{{ $moduleData->get('description') }}</p>
                                </div>




                                @if (Module::canDisable($module->getName()))
                                    @if (Module::isEnable($module->getName()))
                                        <form action="{{ route('admin.main.disable', ['module' => $module->getName()]) }}"
                                            method="POST" id="{{ $module->getName() }}-disable">
                                            @method('PATCH')
                                            @csrf
                                        </form>
                                        <a href="#" class="btn btn-sm btn-danger "
                                            onclick="event.preventDefault();document.getElementById('{{ $module->getName() }}-disable').submit()">Deactivate</a>
                                        <a href="" class="btn btn-sm btn-primary disabled ">Activate</a>
                                    @else
                                        <form action="{{ route('admin.main.enable', ['module' => $module->getName()]) }}"
                                            method="POST" id="{{ $module->getName() }}-enable">
                                            @method('PATCH')
                                            @csrf
                                        </form>
                                        <a href="#" class="btn btn-sm btn-danger disabled ">Deactivate</a>
                                        <a href="" class="btn btn-sm btn-primary "
                                            onclick="event.preventDefault();document.getElementById('{{ $module->getName() }}-enable').submit()">Activate</a>
                                    @endIf
                                @endif



                            </div>
                            {{-- <div class="col-sm-2">
                                <a href="{{ url($module->image) }}">
                                    <img src="{{ url($module->image) }}" class="img-fluid mb-2" alt="{{$module->alt }}">
                                </a>
                                <form action="{{ route('admin.product.gallery.destroy' , ['product' => $product->id , 'gallery' => $module->id]) }}" id="image-{{ $module->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                </form>

                            </div> --}}
                        @endforeach
                    </div>
                </div>

                <!-- /.card-body -->
                {{-- <div class="card-footer">
                    {{ $modules->render() }}
                </div> --}}
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
