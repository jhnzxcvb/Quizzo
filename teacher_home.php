<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizzo Teacher Homepage</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="teacher_style.css">

</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Welcome to Quizzo! (Teacher)</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">Year Level 1</div>
          <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createQuizModal1">Create Quiz</button>
            <a href="#" class="btn btn-secondary">View Analytics</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">Year Level 2</div>
          <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createQuizModal2">Create Quiz</button>
            <a href="#" class="btn btn-secondary">View Analytics</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">Year Level 3</div>
          <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createQuizModal3">Create Quiz</button>
            <a href="#" class="btn btn-secondary">View Analytics</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="createQuizModal1" tabindex="-1" role="dialog" aria-labelledby="createQuizModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createQuizModalLabel1">Create Quiz for Year Level 1</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Create Quiz</button>
          </div>
        </div>
      </div>
    </div>

    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
