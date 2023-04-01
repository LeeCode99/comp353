<!-- SELECT emp.First_name, emp.Last_name, emp.DoB, emp.Email_Address, MIN(w.StartDate) AS First_Day_of_Work, SUM(HOUR(TIMEDIFF(w.EndDate, w.StartDate))) AS Total_Hours_Scheduled
FROM Employees emp
INNER JOIN Work_at w ON emp.EmployeeID = w.EmployeeID
INNER JOIN DegreeOf d ON emp.EmployeeID = d.EmployeeID
WHERE d.RoleID = 1 AND w.EndDate IS NULL
GROUP BY w.EmployeeID
ORDER BY Total_Hours_Scheduled DESC
LIMIT 1; -->
