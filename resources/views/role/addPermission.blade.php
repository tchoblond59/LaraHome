<form class="form-horizontal" method="post" action="{{url('/role/addPermission/'.$role->id)}}">
    <fieldset>
        {{csrf_field()}}
        <!-- Form Name -->
        <legend>Ajouter des permissions à {{$role->name}}</legend>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="permission">Permission</label>
            <div class="col-md-4">
                <select id="permission" name="permission" class="form-control">
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
            <div class="col-md-8"><button type="submit" class="btn btn-default pull-right">Ajouter</button></div>
    </fieldset>
</form>
