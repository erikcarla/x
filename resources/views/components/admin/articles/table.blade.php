@if (count($articles) > 0)
    <div class="panel panel-default admin--articles--table">
        <div class="panel-heading">
            Article
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                @component('components.admin.articles.table.thead')
                @endcomponent

                <!-- Table Body -->
                @component('components.admin.articles.table.tbody', [
                    'articles' => $articles
                    ])
                @endcomponent
            </table>
        </div>
    </div>
@endif
