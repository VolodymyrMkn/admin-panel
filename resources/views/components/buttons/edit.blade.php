<a href="{{ route(str(lcfirst(class_basename($model)))->plural().'.edit',
    [lcfirst(class_basename($model)) => $model]) }}" type="button" class="btn btn-default">
    <i class="fas fa-edit"></i>
</a>
