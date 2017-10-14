<form enctype="multipart/form-data" action="{{ route('admin.article.store') }}" method="POST" class="form-horizontal admin--articles--form">
    {{ csrf_field() }}

    <div class="form-group admin--articles--form__image">
        <label class="col-sm-3 control-label">Cover</label>
        <div class="col-sm-6">
            <input type="file" name="media" class="form-control">
        </div>
    </div>

    <div class="form-group admin--articles--form__title">
        <label class="col-sm-3 control-label">Title</label>
        <div class="col-sm-6">
            <input type="text" name="title" class="form-control">
        </div>
    </div>

    <div class="form-group admin--articles--form__content">
        <label class="col-sm-3 control-label">Content</label>
        <div class="col-sm-6">
            <textarea name="body" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group admin--articles--form__published">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
            <input type="checkbox" name="published" value="1"> Published
        </div>
    </div>

    <div class="form-group admin--articles--form__btn-save">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus"></i> Save
            </button>
        </div>
    </div>
</form>
