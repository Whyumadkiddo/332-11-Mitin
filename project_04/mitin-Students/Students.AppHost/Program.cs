var builder = DistributedApplication.CreateBuilder(args);

var apiService = builder.AddProject<Projects.Students_ApiService>("apiservice");

builder.AddProject<Projects.Students_Web>("webfrontend")
    .WithExternalHttpEndpoints()
    .WithReference(apiService)
    .WaitFor(apiService);

builder.Build().Run();
