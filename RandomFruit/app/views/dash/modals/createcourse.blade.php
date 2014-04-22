<div class="modal fade" id="createCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a Course</h4>
            </div>
            <form class="form" role="form" data-async data-target="createCourse" data-modal-id="createCourse" method="post">
                <div class="modal-body">
                    <div class="form-group" id="code-input">
                        <label for="course-code">Course Code</label>
                        <input type="text" class="form-control" placeholder="Enter course code" id="course-code"
                               name="course-code" required>
                    </div>
                    <div class="form-group" id="description-input">
                        <label for="course-description">Description</label>
                        <input type="text" class="form-control" placeholder="Enter description"
                                  name="course-description" id="course-description">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create Course" data-toggle="modal">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
