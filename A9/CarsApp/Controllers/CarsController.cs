using Microsoft.AspNetCore.Mvc;
using CarsApp.Web.Models;
using CarsApp.Web.Data;
using CarsApp.Web.Models.Entities;
using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Authorization;

namespace CarsApp.Web.Controllers
{
    public class CarsController : Controller
    {
        private readonly ApplicationDBContext dbContext;

        public CarsController(ApplicationDBContext dbContext)
        {
            this.dbContext = dbContext;
        }
        [HttpGet]
        [Authorize]
        public IActionResult Add()
        {
            return View();
        }

        [HttpPost]
        [Authorize]
        public async Task<IActionResult> Add(AddCarViewModel viewModel)
        {
            var car = new Car
            {
                Model = viewModel.Model,
                EnginePower = viewModel.EnginePower,
                Fuel = viewModel.Fuel,
                Price = viewModel.Price,
                Color = viewModel.Color,
                Age = viewModel.Age,
                History = viewModel.History
            };

            await dbContext.Cars.AddAsync(car);
            await dbContext.SaveChangesAsync();

            return RedirectToAction("List", "Cars");
        }

        [HttpGet]
        [Authorize]
        public async Task<IActionResult> List(string selectedModel)
        {
            var models = await dbContext.Cars.Select(c => c.Model).Distinct().ToListAsync();
            var cars = string.IsNullOrEmpty(selectedModel)
                ? await dbContext.Cars.ToListAsync()
                : await dbContext.Cars.Where(c => c.Model == selectedModel).ToListAsync();

            ViewBag.Models = models;
            ViewBag.SelectedModel = selectedModel;
            return View(cars);
        }

        [HttpGet]
        [Authorize]

        public async Task<IActionResult> Edit(Guid id)
        {
            var car = await dbContext.Cars.FindAsync(id);

            return View(car);
        }

        [HttpPost]

        [Authorize]

        public async Task<IActionResult> Edit(Car viewModel)
        {
            var car = await dbContext.Cars.FindAsync(viewModel.Id);
            if (car is not null)
            {
                car.Model = viewModel.Model;
                car.EnginePower = viewModel.EnginePower;
                car.Fuel = viewModel.Fuel;
                car.Price = viewModel.Price;
                car.Color = viewModel.Color;
                car.Age = viewModel.Age;
                car.History = viewModel.History;

                await dbContext.SaveChangesAsync();
            }

            return RedirectToAction("List", "Cars");
        }

        [HttpPost]
        [Authorize]

        public async Task<IActionResult> Delete(Car viewModel)
        {
            var car = await dbContext.Cars.AsNoTracking().FirstOrDefaultAsync(x => x.Id == viewModel.Id);

            if(car is not null)
            {
                dbContext.Cars.Remove(viewModel);
                await dbContext.SaveChangesAsync();
            }
            return RedirectToAction("List", "Cars");
        }

        [HttpGet]
        [Authorize]

        public async Task<IActionResult> Filter()
        {
            var cars = await dbContext.Cars.ToListAsync();
            return View(cars);
        }

    }
}
